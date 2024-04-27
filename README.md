It looks like you're trying to clear the input values and hide/disable the popover content when a tab is changed. However, there seems to be an issue with the implementation.

Here's a corrected version of the code that should properly clear the input values and hide/disable the popover content when a tab is changed:

```javascript
tabs.forEach(tab => {
    if (tab !== targetTab) {
        // Clear input values
        const inputs = tab.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = '';
        });

        // Clear fare content
        const fareView = tab.querySelector('.fare');
        fareView.innerText = '';

        // Hide and disable popover content
        const popoverTrigger = tab.querySelector('.fareDetails');
        if (popoverTrigger) {
            const popover = new bootstrap.Popover(popoverTrigger);
            popover.hide();
            popover.disable();
        }
    }
});
```

In this corrected version, we iterate over each tab. For each tab that is not the target tab, we clear the input values, clear the fare content, and then hide and disable the popover content associated with the fare details.

Make sure to replace the existing code with this corrected version and test to see if it resolves the issue you're encountering.