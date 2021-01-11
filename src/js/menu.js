/**
 * Menu Chevrons change icons to represent open and closed
 */
$(".side-menu .card").on("hide.bs.collapse", function () {
  const icon = this.querySelectorAll(".card-header a i.fa-chevron-down")[0];
  icon.classList.remove("fa-chevron-down")
  icon.classList.add("fa-chevron-right");
});
$(".side-menu .card").on("show.bs.collapse", function () {
  const icon = this.querySelectorAll(".card-header a i.fa-chevron-right")[0];
  icon.classList.remove("fa-chevron-right")
  icon.classList.add("fa-chevron-down");
});