<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>RecipeNest</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous" />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet" />
  <link href="styles.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
  <header class="p-3" style="background-color: var(--header-color)">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo text-center fw-bold fs-4" style="color:var(--bg-color);">
        <i class="bi bi-journal-album fs-1 --bg-color"> </i>
        RecipeNest
      </div>
      <nav class="d-flex gap-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active text-white" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
              Home
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-white" id="add-recipe-tab" data-bs-toggle="modal" data-bs-target="#addRecipeModal" type="button" role="tab" aria-controls="add-recipe" aria-selected="false">
              Add Recipe
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link text-white" id="browse-recipes-tab" data-bs-toggle="tab" data-bs-target="#browse-recipes" type="button" role="tab" aria-controls="browse-recipes" aria-selected="false">
              Browse Recipes
            </button>
          </li>
        </ul>

      </nav>
    </div>
  </header>

  <section id="home"
    class="hero text-white text-center py-5"
    style="background-color: var(--header-color)">
    <div class="container">
      <h1 class="fw-bold">Find Your Next Favorite Recipe!</h1>
      <p class="fs-5">
        Explore thousands of home-cooked and chef-crafted recipes
      </p>
      <div class="input-group w-50 mx-auto mt-4">
        <input type="hidden" name="page" value="MainPage">
        <input type="hidden" name="command" value="SearchRecipe">
        <input
          type="text"
          class="form-control"
          placeholder="Search by category or recipe name"
          id="searchterm" />
        <button class="btn btn-custom" id="submit-search">
          <i class="bi bi-search fs-6 --bg-color"> </i>
          Search
        </button>
      </div>
    </div>
  </section>

  <div id="recipeList"></div>

  <div class="modal" id="addRecipeModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center"> Add Recipe </h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="addRecipeForm" method="POST" action="controller2.php">
            <input type="hidden" name="page" value="MainPage">
            <input type="hidden" name="command" value="AddRecipe">
            <div class="mb-3">
              <label for="recipename" class="form-label"> Recipe Name </label>
              <input type="text" class="form-control" name="recipename" id="recipename">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label"> Category </label>
              <input type="text" class="form-control" name="category" placeholder="e.g Italian" id="category">
            </div>
            <div class="mb-3">
              <label for="recipedescription" class="form-label"> Description </label>
              <input type="text" class="form-control input-lg" name="recipedescription" id="recipedescription">
            </div>
            <div class="mb-3">
              <label for="ingredients" class="form-label"> Ingredients </label>
              <input type="text" class="form-control input-lg" name="ingredients" id="ingredients">
            </div>
            <div class="mb-3">
              <label for="recipename" class="form-label"> Instructions </label>
              <input type="text" class="form-control input-lg" name="instructions" placeholder="username" id="instructions">
            </div>
            <div class="modal-footer">
              <button type="submit" id="submit-post" class="btn btn-success" data-bs-dismiss="modal"> Post </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



</body>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {

    document.getElementById('addRecipeForm').addEventListener('submit', function(e) {
      e.preventDefault(); // Prevent form from submitting traditionally

      const formData = {
        title: document.getElementById('recipename').value,
        category: document.getElementById('category').value,
        description: document.getElementById('recipedescription').value,
        ingredients: document.getElementById('ingredients').value,
        instructions: document.getElementById('instructions').value,
      };

      // Send AJAX request
      fetch('controller.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            page: 'MainPage',
            command: 'AddRecipe',
            data: formData,
          }),
        })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert('Recipe added successfully!');
            // Optionally, refresh the recipes section dynamically
            loadRecipes();
            document.getElementById('addRecipeForm').reset(); // Reset form
            const modal = bootstrap.Modal.getInstance(document.getElementById('addRecipeModal'));
            modal.hide(); // Close modal
          } else {
            alert('Error adding recipe: ' + data.message);
          }
        })
        .catch((error) => {
          console.error('Error:', error);
          alert('An unexpected error occurred.');
        });

    });

    function loadRecipes() {
      fetch('controller.php?page=MainPage&command=FetchRecipes')
        .then((response) => response.json())
        .then((data) => {
          const recipeList = document.getElementById('recipeList');
          recipeList.innerHTML = ''; // Clear existing recipes

          data.recipes.forEach((recipe) => {
            const recipeItem = `
          <div class="recipe">
            <h3>${recipe.title}</h3>
            <h3>${recipe.category}<h3>
            <p><strong>Description:</strong>${recipe.description}</p>
            <p><strong>Ingredients:</strong> ${recipe.ingredients}</p>
            <p><strong>Instructions:</strong> ${recipe.instructions}</p>
          </div>
        `;
            recipeList.innerHTML += recipeItem;
          });
        })
        .catch((error) => console.error('Error fetching recipes:', error));
    }



    /*
    $('#submit-post').click(function() {
      event.preventDefault();
      var xhttp = new XMLHttpRequest(); //create new ajax object
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('recipes').innerHTML = this.responseText;
        }
      };
      var controller = '//cs.tru.ca/~w3jadebayo/Termproject/controller2.php';
      var query = 'page=MainPage&command=AddRecipe' + encodeURIComponent(formData);
      xhttp.open('POST', controller, true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send(query);
      $('#addRecipeModal').hide();
    });

    $('#submit-search').click(function() {
      event.preventDefault();
      var xhttp = new XMLHttpRequest(); //create new ajax object
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById('recipes').innerHTML = this.responseText;
        }
      };
      var controller = '//cs.tru.ca/~w3jadebayo/Termproject/controller2.php';
      var query = 'page=MainPage&command=SearchRecipe' + encodeURIComponent(document.getElementById('searchterm').value);
      xhttp.open('POST', controller, true);
      xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhttp.send(query);
    });

    */


  });
</script>

</html>