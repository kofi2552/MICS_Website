
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="../blog/main/main.js"></script>



<!-- Your custom script -->
<script>
    $(document).ready(function() {
        $('.btn-link').click(function() {
            var $collapse = $($(this).attr('data-target'));
            if ($collapse.hasClass('show')) {
                $collapse.collapse('hide');
            } else {
                $collapse.collapse('show');
            }
        });

        // Hide collapse when clicked outside
        $(document).on('click', function(event) {
            var $target = $(event.target);
            if (!$target.closest('.collapse').length && !$target.closest('.btn-link').length) {
                $('.collapse').each(function() {
                    $(this).collapse('hide');
                });
            }
        });
    });
</script>

<p class="text-center p-10">2024 MICS Website</p>

</body>
</html>