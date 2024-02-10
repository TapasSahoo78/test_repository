If you want to disable multiple fields based on certain conditions, you can iterate over those fields and disable them accordingly. Here's an example extending the previous one to disable multiple fields:

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hide and Show Form Inputs</title>
<style>
  .hiddenField {
    display: none; /* Initially hide the input */
  }
</style>
</head>
<body>

<form id="myForm" action="submit.php" method="POST">
  <label for="toggleInput">Show Inputs:</label>
  <input type="checkbox" id="toggleInputCheckbox">

  <div id="hiddenFields">
    <div class="hiddenField">
      <label for="textInput1">Input Field 1:</label>
      <input type="text" id="textInput1">
    </div>
    <div class="hiddenField">
      <label for="textInput2">Input Field 2:</label>
      <input type="text" id="textInput2">
    </div>
  </div>

  <button type="submit">Submit</button>
</form>

<script>
  const toggleInputCheckbox = document.getElementById('toggleInputCheckbox');
  const hiddenFields = document.querySelectorAll('.hiddenField');

  toggleInputCheckbox.addEventListener('change', function() {
    hiddenFields.forEach(field => {
      if (this.checked) {
        field.style.display = 'block'; // Show the field
      } else {
        field.style.display = 'none'; // Hide the field
      }
    });
  });

  document.getElementById('myForm').addEventListener('submit', function() {
    if (!toggleInputCheckbox.checked) {
      hiddenFields.forEach(field => {
        const input = field.querySelector('input');
        input.disabled = true; // Disable the input field
      });
    }
  });
</script>

</body>
</html>
```

In this example, we have two hidden input fields within the `#hiddenFields` div. When the checkbox is checked, both fields are displayed, and when it's unchecked, both fields are hidden and disabled before form submission. You can add more fields and customize the behavior as needed.