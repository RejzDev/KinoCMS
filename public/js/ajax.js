function removeImage(id, dir){

    console.log(id);
    console.log('image_'+id);
    console.log(dir);
    var patch = document.getElementById('image_'+id).value;
    console.log(patch);
    document.getElementById('img-'+id).src="Storage::disk('public')->url('catalog/movie/source/no-img.jpg'";

    if(dir == 'movie'){
       var url = "/image/removeImage";
    }
    else if (dir == 'cinema'){
        var url = "/cinema-image/removeImage";
    } else if (dir == 'hall'){
        var url = "/hall-image/removeImage";
    }

    $.ajax({

        url: url,
        type: "POST",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        data: {patch: patch,
                dir: dir},
        success: (data) => {
            console.log(data)
        },
        error: (data) => {
            console.log(data)
        }
    });
}

function deletes(id){

    var hall = document.getElementById("hall_"+id);
    hall.remove();
     $.ajax({
        url: "/hall/"+id,
        type: "DELETE",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        success: (data) => {
            console.log(data)

        },
        error: (data) => {
            console.log(data)
        }
    });
}
