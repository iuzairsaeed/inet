var $ph, axisY;

$('.home-dnd-item').hqyDraggable({
    proxy: 'clone',
    onStartDrag: function (event, target) {
        $(target).width($(this).width());

        $ph = $(this).clone();
        $ph.addClass('op2');
        $(this).hide().before($ph);
    },
    onStopDrag: function () {
        $ph.after(this);
        $ph.remove();
        $ph = null;
        $(this).show();
    }
});

$('.home-dnd-item').hqyDroppable({
    onDragEnter: function () {
        axisY = 0;
    },
    onDragOver: function (event, target) {
        if (event.data.top > axisY) {
            $(this).after($ph);
        } else {
            $(this).before($ph);
        }

        axisY = event.data.top;
    }
});

$('.home-dnd .list').hqyDroppable({
    onDragEnter: function (event, target) {
        var $filter = $(this).find('.home-dnd-item:visible').filter(function () {
            return this !== target;
        });

        if ($filter.length <= 0) {
            $(this).append($ph);
        }
    }
});