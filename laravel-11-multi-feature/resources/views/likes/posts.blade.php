
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready() {
        $.ajaxSetup({
            headers:
            'X-CSRF-TOKEN': $('meta[name="scrf-token"]').attr('content')
        });

        $('.like-box i').click(function () {
            let id = $(this).attr('data-post-id');
            let boxObj = $(this).parent('div');
            let c = $(this).parent('div').find('span').text();
            let like = $(this).hasClass('like') ? 1 : 0;

            $.ajax({
                type: 'POST',
                url: "{{ route('ld.store') }}",
                data: { id: id, like: like },
                success: function(data) {
                    if(data.success.hasLiked === true) {

                        if($(boxObj).find('.dislike').hasClass('fa-solid')) {
                            let dislike = $(boxObj).find('.dislike-count').text();
                            $(boxObj).find(".dislike-count").text(parseInt(dislikes)-1);
                        }

                        $(boxObj).find(".like").removeClass("fa-regular");
                        $(boxObj).find(".like").addClass("fa-solid");

                        $(boxObj).find(".dislike").removeClass("fa-solid");
                        $(boxObj).find(".dislike").addClass("fa-regular");

                        var likes = $(boxObj).find(".like-count").text();
                        $(boxObj).find(".like-count").text(parseInt(likes)+1);

                    } 
                }
            })
        })
    }
</script>
@endsection
