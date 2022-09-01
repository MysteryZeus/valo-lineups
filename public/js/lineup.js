$(window).on('load', () => {
    $.get('/api/search.php' + window.location.search, (data) => {
        for (let lineup of JSON.parse(data)) {
            let li = "<li></li>";
            let ul = "<ul></ul>";

            let desc = $(`<li><span>${lineup['description']}</span></li>`);
            let image_position = $(`<li><img src="${lineup['image_position']}"></li>`);
            let image_aim = $(`<li><img src="${lineup['image_aim']}"></li>`);
            let video = $(`<li><div class="container"><iframe src="https://www.youtube.com/embed/${lineup['video_id']}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div></li>`);

            $('#list').append($(li).append($(ul).append(desc, image_position, image_aim, video)));
        }
    });
    if (document.location.search.startsWith('?agent=')) {
        let i = document.location.search.indexOf('&');
        if (i < 0) i = document.location.search.length;
        let name = document.location.search.substr(7, i-7);
        $.get('api/agent.php?name=' + name, (data) => {
            let json = JSON.parse(data)[0];
            $('#agent').attr('src', json['image']);
            let title = `${json['name']} Lineups`;
            $('#title').text(title);
            document.title = title;
        });
    }
});