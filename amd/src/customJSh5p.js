document.addEventListener("DOMContentLoaded", function () {
    // Seu código aqui
    var link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/styles/default.min.css";
    document.head.appendChild(link);

    var script1 = document.createElement("script");
    script1.src = "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/highlight.min.js";
    document.body.appendChild(script1);

    var script2 = document.createElement("script");
    script2.src = "https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.8.0/languages/go.min.js";
    document.body.appendChild(script2);

    script1.onload = script2.onload = function () {
        hljs.highlightAll();
    };
});