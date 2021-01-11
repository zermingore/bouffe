<html>
<body>

<h1>Add recipe</h1>

<form method="post" action="handle_add_recipe.php">

  <hr/>
  Name: <input type="text" name="name"><br/>
  Summary: <input type="text" name="summary">

  <br/><br/>
  <h3>Time</h3>
  time total: <input type="text" name="time_total"><br/>
  time preparation: <input type="text" name="time_preparation"><br/>
  time crafting: <input type="text" name="time_crafting"><br/>
  time backing: <input type="text" name="time_backing"><br/>

  <br/><br/>
  Difficulty:<br/>
  <input type="radio" name="difficulty" value="1">1
  <input type="radio" name="difficulty" value="2">2
  <input type="radio" name="difficulty" value="3" checked="checked">3
  <input type="radio" name="difficulty" value="4">4
  <input type="radio" name="difficulty" value="5">5
  <input type="radio" name="difficulty" value="6">5+

  <br/><br/>
  Annoyance:<br/>
  <input type="radio" name="annoyance" value="1">1
  <input type="radio" name="annoyance" value="2">2
  <input type="radio" name="annoyance" value="3" checked="checked">3
  <input type="radio" name="annoyance" value="4">4
  <input type="radio" name="annoyance" value="5">5
  <input type="radio" name="annoyance" value="6">5+

  <br/><br/>
  Threads (ideal number of people working together):<br/>
  <input type="radio" name="threads" value="1" checked="checked">1
  <input type="radio" name="threads" value="2">2
  <input type="radio" name="threads" value="3">3
  <input type="radio" name="threads" value="4">4
  <input type="radio" name="threads" value="5">5
  <input type="radio" name="threads" value="6">5+

  <br/><br/>
  Quantity: <input type="text" name="quantity"><br/>

  <br/><br/>
  <hr/>
  <h3>Ingredients</h3>
  Ingredients (One per line):<br/>
  <textarea name="ingredients" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  <h3>Steps</h3>
  Steps (One per line):<br/>
  <textarea name="steps" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  Notes (one per line):<br/>
  <textarea name="notes" rows="5" cols="80"></textarea>

  <br/><br/>
  <hr/>
  <input type="submit" value="Add">

  </form>

</body>
</html>
