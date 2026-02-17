(function () {
  const slider = document.querySelector("[data-slider]");
  if (!slider) return;

  const viewport = slider.querySelector(".slider__viewport");
  const slides = Array.from(slider.querySelectorAll(".slide"));
  const prevBtn = slider.querySelector("[data-prev]");
  const nextBtn = slider.querySelector("[data-next]");
  const dotsWrap = slider.querySelector(".dots");

  let index = 0;
  const total = slides.length;

  function renderDots() {
    dotsWrap.innerHTML = "";
    for (let i = 0; i < total; i++) {
      const d = document.createElement("button");
      d.className = "dot" + (i === index ? " active" : "");
      d.type = "button";
      d.setAttribute("aria-label", `Go to slide ${i + 1}`);
      d.addEventListener("click", () => goTo(i));
      dotsWrap.appendChild(d);
    }
  }

  function goTo(i) {
    index = (i + total) % total;
    viewport.style.transform = `translateX(-${index * 100}%)`;
    renderDots();
  }

  function next() { goTo(index + 1); }
  function prev() { goTo(index - 1); }

  nextBtn?.addEventListener("click", next);
  prevBtn?.addEventListener("click", prev);

  renderDots();
  goTo(0);

  // autoplay (optional)
  const autoplay = slider.getAttribute("data-autoplay") === "true";
  const interval = Number(slider.getAttribute("data-interval") || "4500");
  if (autoplay) {
    let t = setInterval(next, interval);
    slider.addEventListener("mouseenter", () => clearInterval(t));
    slider.addEventListener("mouseleave", () => (t = setInterval(next, interval)));
  }
})();
