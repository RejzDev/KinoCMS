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
    }
    else if (dir == 'hall'){
        var url = "/hall-image/removeImage";
    }
    else if (dir == 'news'){
        var url = "/admin_panel/news-image/removeImage";
    }
    else if (dir == 'action'){
        var url = "/admin_panel/action-image/removeImage";
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

function deleteMail(id){
    var mail = document.getElementById("mail_"+id);
    mail.remove();
    $.ajax({
        url: "mail-destroy",
        type: "POST",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType : 'json',
        data: {
            id: id
        },
        success: (data) => {


        },
        error: (data) => {
            console.log(data)
        }
    });
}


function removeBanner(id){

    var banner = document.getElementById("banner_"+id);
    banner.remove();
    $.ajax({
        url: "/main-banner/"+id,
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

function removeBgBanner(id){

    var banner = document.getElementById("bgBanner_"+id);
    banner.remove();
    $.ajax({
        url: "/bg_banner/"+id,
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

function removeNewsBanner(id){

    var banner = document.getElementById("newsBanner_"+id);
    banner.remove();
    $.ajax({
        url: "/news-banner/"+id,
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


