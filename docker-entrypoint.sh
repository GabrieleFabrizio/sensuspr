#!/bin/bash
set -e

# Generate msmtp config from environment variables at container start
{
    echo "defaults"
    echo "logfile /var/log/msmtp.log"
    echo ""
    echo "account default"
    echo "host ${SMTP_HOST:-mailpit}"
    echo "port ${SMTP_PORT:-1025}"
    echo "from ${SEND_EMAIL:-noreply@sensuspr.com}"

    if [ "${SMTP_TLS:-off}" = "on" ]; then
        echo "tls on"
        echo "tls_trust_file /etc/ssl/certs/ca-certificates.crt"
        # Port 465 = implicit SSL (tls_starttls off); port 587 = STARTTLS (default, on)
        if [ "${SMTP_PORT:-587}" = "465" ]; then
            echo "tls_starttls off"
        fi
    else
        echo "tls off"
    fi

    if [ -n "${SMTP_USER}" ]; then
        echo "auth on"
        echo "user ${SMTP_USER}"
        echo "password ${SMTP_PASSWORD}"
    else
        echo "auth off"
    fi
} > /etc/msmtprc

# Apache workers run as www-data, not root, so root-only 600 left msmtp
# unable to read its own config when PHP's mail() shelled out to it.
chown root:www-data /etc/msmtprc
chmod 640 /etc/msmtprc

exec "$@"
