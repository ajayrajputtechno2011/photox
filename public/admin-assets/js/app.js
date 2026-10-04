const sidebar = document.querySelector("#sidebar");
const menuToggle = document.querySelector("#menuToggle");
const sidebarBackdrop = document.querySelector("#sidebarBackdrop");

function setSidebarState(isOpen) {
  if (!sidebar || !menuToggle || !sidebarBackdrop) return;
  sidebar.classList.toggle("is-open", isOpen);
  sidebarBackdrop.classList.toggle("is-visible", isOpen);
  menuToggle.setAttribute("aria-expanded", String(isOpen));
}

menuToggle?.addEventListener("click", () => {
  setSidebarState(!sidebar.classList.contains("is-open"));
});

sidebarBackdrop?.addEventListener("click", () => setSidebarState(false));

document.querySelectorAll(".chart svg").forEach((chart) => {
  chart.querySelectorAll(".chart-line, .chart-order-line").forEach((line) => {
    const length = line.getTotalLength();
    line.style.strokeDasharray = length;
    line.style.strokeDashoffset = length;
    requestAnimationFrame(() => {
      line.style.transition = "stroke-dashoffset 900ms ease";
      line.style.strokeDashoffset = "0";
    });
  });
});
