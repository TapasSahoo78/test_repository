To open a modal after submitting an HTML form, you can use JavaScript to handle the form submission and show the modal. Here's a basic example:

Let's assume you have an HTML form like this:

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form with Modal</title>
  <!-- Add your CSS stylesheets and JavaScript files here -->
</head>
<body>
  <form id="myForm">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <button type="submit">Submit</button>
  </form>

  <!-- Modal -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Form submitted successfully!</p>
    </div>
  </div>

  <!-- Add your JavaScript at the end of the body -->
  <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    document.getElementById("myForm").addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent form submission
      modal.style.display = "block";
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  </script>
</body>
</html>
```

In this example:

1. We have an HTML form with an id of `myForm` and a submit button.
2. We have a modal with an id of `myModal` that contains a message.
3. When the form is submitted (`submit` event), we prevent the default form submission using `event.preventDefault()` to keep the page from reloading.
4. Then, we set the `display` property of the modal to `"block"` to make it visible.
5. The modal has a close button (`<span class="close">&times;</span>`) that, when clicked, sets the `display` property of the modal back to `"none"`, hiding it.
6. Additionally, clicking anywhere outside the modal will also close it.

This is a very basic example. You might want to enhance it further by adding CSS styles for your modal, adding form validation, sending form data to a server using AJAX, etc., depending on your requirements.