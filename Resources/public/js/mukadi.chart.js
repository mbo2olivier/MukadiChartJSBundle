(function($){
    var charts = {};
    $('.mukadi_chartJs_container').each(function(){
        id = $(this).data('target');
        config = {
            type: $(this).data('chart-type'),
            data: {
                labels: $(this).data('labels'),
                datasets: $(this).data('datasets')
            },
            options: $(this).data('options')
        };
        chart = new Chart($("#"+id),config);
        charts[id]=chart;
    });
    window.mukadi_charts={
        get: function(id){
            return charts[id];
        }
    }
})(jQuery);