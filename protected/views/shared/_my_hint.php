
    <script>
        $(document).ready(function () {
            $('.myHint').on('click', function () {
                var a = $(this);
                if (a.hasClass('my-clicked')) {
                    a.removeClass('my-clicked');
                    a.popover('hide');
                    a.on('mouseenter', function() {
                        $(this).popover('show');
                    });
                    a.on('mouseleave', function() {
                        $(this).popover('hide');
                    });
                } else {
                    a.addClass('my-clicked');
                    a.popover('show');
                    a.off('mouseenter');
                    a.off('mouseleave');
                }
            });
            $(".myHint").on('mouseenter', function() {
                $(this).popover('show');
            });
            $('.myHint').on('mouseleave', function() {
                $(this).popover('hide');
            });

            $(".delete-title").tooltip({'placement':'top'});

            $(document).on('click', '.js-not-allowed', function() {
                return false;
            });
        });
    </script>
