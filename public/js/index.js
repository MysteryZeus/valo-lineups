$(window).on('load', () => {
    $('#agents td').click((e) => {
        $('#agents td').not(e.currentTarget).removeClass('selected');
        $(e.currentTarget).toggleClass('selected');
    });
    $('#maps td').click((e) => {
        $('#maps td').not(e.currentTarget).removeClass('selected');
        $(e.currentTarget).toggleClass('selected');
    });
    $("#search").click((e) => {
        let agent = $('#agents .selected').text();
        let map = $('#maps .selected').text();

        agent = agent ? agent : 'ALL';
        map = map ? map : 'ALL';

        if (agent != 'ALL' || map != 'ALL')
            window.location = `/${map}/${agent}`;
    });
});