<span id="code{{$id}}" class="badge bg-secondary" style="display: none">{{$code}}</span>
    <a class="text-decoration-none" id="togglelink{{$code}}">Show</a>
<script>
    document.getElementById('togglelink{{$code}}').addEventListener('click', function() {
        var codeElement = document.getElementById('code{{$id}}');
        if (codeElement.style.display === 'none') {
            codeElement.style.display = 'inline';
            this.textContent = 'Hide';
        } else {
            codeElement.style.display = 'none';
            this.textContent = 'Show';
        }
    });
</script>