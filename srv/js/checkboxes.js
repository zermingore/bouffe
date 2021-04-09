function VeganCheck()
{
  var vegan = document.getElementById("Vegan");
  var vegetarian = document.getElementById("Vegetarian");

  if (vegan.checked)
    vegetarian.checked = true;
}



function VegetarianCheck()
{
  var vegan = document.getElementById("Vegan");
  var vegetarian = document.getElementById("Vegetarian");

  if (vegetarian.checked == false)
    vegan.checked = false;
}
