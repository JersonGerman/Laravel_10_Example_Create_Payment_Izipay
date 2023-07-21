<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/dracula.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="skinned/assets/paid.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('pre code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <h2>Raw POST data received:</h2>
        <pre><code class="json">{{ $dataPost }}</code></pre>

        <h2>Parsed POST data:</h2>
        <pre><code class="json">{{ $formAnswer }}</code></pre>
    </div>

    <h1>{{$title}}</h1>
    <h1><a href="/">Back to home</a></h1>

</body>

</html>
