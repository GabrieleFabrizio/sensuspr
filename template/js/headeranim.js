class TextScramble {
    constructor(el) {
      this.el = el;
      this.chars = "!<>-_\\/[]{}—=+*^?#________";
      this.update = this.update.bind(this);
    }
    setText(newText) {
      const oldText = this.el.innerText;
      const length = Math.max(oldText.length, newText.length);
      const promise = new Promise((resolve) => (this.resolve = resolve));
      this.queue = [];
      for (let i = 0; i < length; i++) {
        const from = oldText[i] || "";
        const to = newText[i] || "";
        const start = Math.floor(Math.random() * 40);
        const end = start + Math.floor(Math.random() * 40);
        this.queue.push({ from, to, start, end });
      }
      cancelAnimationFrame(this.frameRequest);
      this.frame = 0;
      this.update();
      return promise;
    }
    update() {
      let output = "";
      let complete = 0;
      for (let i = 0, n = this.queue.length; i < n; i++) {
        let { from, to, start, end, char } = this.queue[i];
        if (this.frame >= end) {
          complete++;
          output += to;
        } else if (this.frame >= start) {
          if (!char || Math.random() < 0.28) {
            char = this.randomChar();
            this.queue[i].char = char;
          }
          output += `<span class="dud">${char}</span>`;
        } else {
          output += from;
        }
      }
      this.el.innerHTML = output;
      if (complete === this.queue.length) {
        this.resolve();
      } else {
        this.frameRequest = requestAnimationFrame(this.update);
        this.frame++;
      }
    }
    randomChar() {
      return this.chars[Math.floor(Math.random() * this.chars.length)];
    }
  }
  
  function headerAnim(titlesDelay,title, titles, subt1, subt2, phrases) {
    if (titles.length !== phrases.length) {
      console.error(
        "titles and subtitle arrays must contain the same n. of elements"
      );
      return;
    }
    // adjust the variables to the fields
    let phrases1 = [];
    let phrases2 = [];
  
    // Loop through each element in the phrases array
    for (let i = 0; i < phrases.length; i++) {
      // Check if the first element of the inner array exists and push it to phrases1
      if (phrases[i][0]) {
        phrases1.push(phrases[i][0]);
      }
  
      // Check if the second element of the inner array exists and push it to phrases2
      if (phrases[i][1]) {
        phrases2.push(phrases[i][1]);
      }
    }
  
    // Printing effect
    function printChar(word, target) {
      let text = document.querySelector(target);
      let i = 0;
      text.innerHTML = "";
      let id = setInterval(() => {
        if (i >= word.length) {
          clearInterval(id);
          setTimeout(() => {
            deleteChar(target);
          }, 4000);
        } else {
          text.innerHTML += word[i];
          i++;
        }
      }, 100);
    }
  
    // Deleting effect
    function deleteChar(target) {
      let text = document.querySelector(target);
      let word = text.innerHTML;
      let i = word.length - 1;
      let id = setInterval(() => {
        if (i >= 0) {
          text.innerHTML = text.innerHTML.substring(0, text.innerHTML.length - 1);
          i--;
        } else {
          renderText(gen.next().value);
          clearInterval(id);
        }
      }, 50);
    }
  
    const TXscramble = (sentence, target) => {
      const el = document.querySelector(target);
      const fx = new TextScramble(el);
      fx.setText(sentence);
    };
  
    // calls all the text changing functions and sets a delay between
    function renderText(order) {
      printChar(titles[order], title);
      setTimeout(function () {
        TXscramble(phrases1[order], subt1);
        if (subt2) {
          TXscramble(phrases2[order], subt2);
        }
      }, titlesDelay);
    }
  
    // Generator (iterate from 0-3)
    function* generator() {
      var index = 0;
      while (true) {
        yield index++;
  
        if (index > titles.length - 1) {
          index = 0;
        }
      }
    }
  
    // Initializing generator
    let gen = generator();
    let order = gen.next().value;
    globalThis.title = title;
  
    renderText(order);
  }
  