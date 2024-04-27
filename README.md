 <h6> FARE ESTIMATED
                                                <div hidden>
                                                    <div data-name="popover-content">
                                                        <table>
                                                            <tr>
                                                                <td><strong>Distance (first 5kms free)</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Hourly Price</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>GST</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Subtotal</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Previous Due Amount</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Round Off</strong></td>
                                                                <td>&nbsp;&nbsp;<span>₹100.00</span></td>
                                                            </tr>

                                                            <tr>
                                                                <td>
                                                                    <hr><strong>Estimated Total Fare</strong>
                                                                </td>
                                                                <td>
                                                                    <hr>&nbsp;&nbsp;<span><strong>₹100.00</strong></span>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </div>
                                                </div>

                                                <a id="example11" tabindex="0" class="popover-trigger fareDetails"
                                                    role="button" data-bs-toggle="popover"
                                                    title="Estimated Fare Details">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="6%" height="6%"
                                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M256 8C119 8 8 119.1 8 256c0 137 111 248 248 248s248-111 248-248C504 119.1 393 8 256 8zm0 110c23.2 0 42 18.8 42 42s-18.8 42-42 42-42-18.8-42-42 18.8-42 42-42zm56 254c0 6.6-5.4 12-12 12h-88c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h12v-64h-12c-6.6 0-12-5.4-12-12v-24c0-6.6 5.4-12 12-12h64c6.6 0 12 5.4 12 12v100h12c6.6 0 12 5.4 12 12v24z" />
                                                    </svg>
                                                </a>

                                            </h6>




tabs.forEach(tab => {
                    if (tab !== targetTab) {
                        const inputs = tab.querySelectorAll('input');
                        inputs.forEach(input => {
                            input.value = ''; // Clear input value
                            tab.querySelector('.fare').innerText = '';
                            
                            // Select elements with the class "fareDetails"
                            var elements = $('.fareDetails');

                            elements.each(function(index, element) {
                                // Check if a popover is already initialized on the element
                                if ($(this).data('bs.popover')) {
                                    // Get the existing popover instance
                                    var popover = $(this).data('bs.popover');

                                    // Hide and disable the popover
                                    popover.hide();
                                    popover.disable();
                                }
                            });
                        });
                    }
                });

When tab chnage popover title and content hide and disable
