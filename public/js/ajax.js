function removeImage(id, movie){

    console.log(id);
    console.log('image_'+id);
    var patch = document.getElementById('image_'+id).value;
    console.log(patch);
    document.getElementById('img-'+id).src="Storage::disk('public')->url('catalog/movie/source/no-img.jpg'";
    $.ajax({
        url: "/image/removeImage",
        type: "POST",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        data: {patch: patch},
        success: (data) => {
            console.log(data)
        },
        error: (data) => {
            console.log(data)
        }
    });
}
