(function() {
    var section = document.querySelector('.section-booking');
    if (!section) return;
    var target = section.getAttribute('data-slot-target') || '/reservation';

    var SLOTS_WEEKDAY = ['18:00', '19:30', '21:00', '22:30'];
    var DAYS   = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    var MONTHS = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

    var current = new Date();

    function fmt(d) {
        return DAYS[d.getDay()] + ' ' + d.getDate() + ' ' + MONTHS[d.getMonth()] + ' ' + d.getFullYear();
    }

    function render() {
        document.getElementById('booking-date-text').textContent = fmt(current);
        var container = document.getElementById('time-slots-container');
        var now      = new Date();
        var isToday  = current.toDateString() === now.toDateString();
        var isSunday = current.getDay() === 0;

        container.innerHTML = '';

        if (isSunday) {
            var ferme = document.createElement('div');
            ferme.className = 'time-slot complet';
            ferme.textContent = 'Fermé';
            container.appendChild(ferme);
            return;
        }

        SLOTS_WEEKDAY.forEach(function(slot) {
            var parts = slot.split(':');
            var h = parseInt(parts[0]);
            var m = parseInt(parts[1]);
            var isPast = isToday && (now.getHours() > h || (now.getHours() === h && now.getMinutes() >= m));
            var div = document.createElement('div');
            if (isPast) {
                div.className = 'time-slot complet';
                div.textContent = 'Complet';
            } else {
                div.className = 'time-slot available';
                div.innerHTML = '<a href="' + target + '" class="slot-link">' + slot + '</a>';
            }
            container.appendChild(div);
        });
    }

    document.getElementById('prevDay').addEventListener('click', function() {
        current.setDate(current.getDate() - 1);
        render();
    });
    document.getElementById('nextDay').addEventListener('click', function() {
        current.setDate(current.getDate() + 1);
        render();
    });

    render();
})();
