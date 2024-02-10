It seems like you've provided a script that aims to toggle the visibility of certain fields based on the value of a checkbox (`payment_mode`). Additionally, it disables certain fields if the checkbox's value is not 'online'. However, it looks like there are some issues in your script. Let me point them out:

1. In your script, you're using `getElementById` to get the element with the id `'payment_mode'`, but you're referring to it as a checkbox. If it's supposed to be a checkbox, you should use `document.querySelector('[name="payment_mode"]')` or `document.getElementById('payment_mode_checkbox')`, assuming you have an element with that id.

2. You're checking `toggleInputCheckbox.value` in your submit event listener. If `toggleInputCheckbox` is indeed a checkbox, you should check its `checked` property to see if it's checked or not.

Here's a corrected version of your script assuming 'payment_mode' is a checkbox:

```html
<script>
  const toggleInputCheckbox = document.querySelector('[name="payment_mode"]');
  const hiddenFields = document.querySelectorAll('.hiddenField');

  toggleInputCheckbox.addEventListener('change', function() {
    hiddenFields.forEach(field => {
      if (this.checked && this.value === 'cash') {
        field.style.display = 'none'; // Hide the field
      } else {
        field.style.display = 'block'; // Show the field
      }
    });
  });

  document.getElementById('myForm').addEventListener('submit', function(event) {
    if (!toggleInputCheckbox.checked || toggleInputCheckbox.value !== 'online') {
      hiddenFields.forEach(field => {
        const input = field.querySelector('input');
        input.disabled = true; // Disable the input field
      });
    }
    
    // Prevent the form from submitting for demonstration purposes
    event.preventDefault();
  });
</script>
```

Make sure to replace `'payment_mode_checkbox'` with the correct id of your checkbox if it's not 'payment_mode_checkbox'. Additionally, ensure that your checkbox has the attribute `name="payment_mode"` if you're using `querySelector('[name="payment_mode"]')`.