<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quill Editor with Code</title>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css">
</head>
<body>
    <h1>Quill Editor with Syntax Highlighting</h1>
    <form action="{{ route('save.code') }}" method="POST">
        @csrf
        <div id="editor-container" style="height: 400px;"></div>
        <textarea name="content" id="content" hidden></textarea>
        <button type="submit">Save Code</button>
    </form>

    <!-- Include Quill and Highlight.js -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js"></script>

    <script>
        // Initialize Highlight.js
        hljs.configure({ languages: ['javascript', 'python', 'php', 'html', 'css', 'java', 'csharp', 'go', 'ruby'] });

        // Initialize Quill Editor with Syntax Highlighting
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                syntax: true, // Enable syntax module
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ['code-block', 'link', 'image'], // Add code block option
                ]
            }
        });

        // Sync content to textarea on form submission
        document.querySelector('form').onsubmit = function () {
            document.querySelector('#content').value = quill.root.innerHTML;
        };
    </script>
</body>
</html>