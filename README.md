// Add event listener for tab change
        tabContent.addEventListener('click', function(event) {
            const targetTab = event.target.closest('.tab-pane');
            if (!targetTab) return;

            tabs.forEach(tab => {
                if (tab !== targetTab) {
                    const inputs = tab.querySelectorAll('input');
                    inputs.forEach(input => {
                        input.value = ''; // Clear input value
                    });
                }
            });
        });