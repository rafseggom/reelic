var icon = document.getElementById("icon");
var iconArea = document.getElementById("iconArea");

iconArea.onmouseover = function () {
  if (icon.className === "Icon") {
    icon.className = "Icon open";

  } iconArea.onmouseout = function () {
    icon.className = "Icon";
  }
};