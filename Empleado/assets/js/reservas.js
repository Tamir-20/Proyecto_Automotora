document.addEventListener('DOMContentLoaded', function() {
    // Sample reservation data
    const reservations = [
        {
            id: 1,
            title: 'Cambio de aceite',
            start: '2025-10-15T10:00:00',
            service: 'Cambio de aceite',
            employee: 'Juan Pérez',
            status: 'confirmado'
        },
        {
            id: 2,
            title: 'Revisión general',
            start: '2025-10-22T14:00:00',
            service: 'Revisión general',
            employee: 'María García',
            status: 'pendiente'
        },
        {
            id: 3,
            title: 'Alineación',
            start: '2023-10-17T09:00:00',
            service: 'Alineación',
            employee: 'Carlos López',
            status: 'canceled'
        },
        {
            id: 4,
            title: 'Cambio de frenos',
            start: '2023-10-20T11:00:00',
            service: 'Cambio de frenos',
            employee: 'Ana Rodríguez',
            status: 'confirmado'
        }
    ];

    // Initialize FullCalendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        locale: 'es', // Set locale to Spanish
        buttonText: {
            today: 'Hoy' // Change 'today' button text to 'Hoy'
        },
        events: reservations.map(res => ({
            title: res.service, // Use service name as event title
            start: res.start,
            className: res.status
        })),
        eventMouseEnter: function(info) {
            showTooltip(info);
        },
        eventMouseMove: function(info) {
            moveTooltip(info);
        },
        eventMouseLeave: function(info) {
            hideTooltip();
        },
        eventClick: function(info) {
            showDetails(info.event);
        },
        dayCellDidMount: function(info) {
            // Mark days based on reservation status
            const dayReservations = reservations.filter(r => r.start.startsWith(info.dateStr));
            if (dayReservations.length > 0) {
                if (dayReservations.some(r => r.status === 'confirmado')) {
                    info.el.classList.add('confirmed-day');
                }
                if (dayReservations.some(r => r.status === 'pendiente')) {
                    info.el.classList.add('pending-day');
                }
                if (dayReservations.some(r => r.status === 'canceled')) {
                    info.el.classList.add('canceled-day');
                }
            }
        }
    });
    calendar.render();

    // Tooltip element
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    document.body.appendChild(tooltip);

    // Function to show tooltip
    function showTooltip(info) {
        const event = info.event;
        let servicio = event.extendedProps.service;
        if (servicio === undefined || servicio === null || servicio === '') {
            servicio = 'indefinido';
        }
        let empleado = event.extendedProps.employee;
        if (empleado === undefined || empleado === null || empleado === '') {
            empleado = 'indefinido';
        }
        let estado = event.extendedProps.status;
        if (estado === undefined || estado === null || estado === '') {
            estado = 'indefinido';
        }
        const details = `Servicio: ${servicio}\nHora: ${event.start.toLocaleTimeString()}\nEmpleado: ${empleado}\nEstado: ${estado}`;
        tooltip.textContent = details;
        tooltip.style.display = 'block';
        positionTooltip(info);
    }

    // Function to move tooltip with mouse
    function moveTooltip(info) {
        positionTooltip(info);
    }

    // Function to position tooltip
    function positionTooltip(info) {
        const rect = info.jsEvent.target.getBoundingClientRect();
        tooltip.style.top = (rect.top + window.scrollY - tooltip.offsetHeight - 8) + 'px';
        tooltip.style.left = (rect.left + window.scrollX) + 'px';
    }

    // Function to hide tooltip
    function hideTooltip() {
        tooltip.style.display = 'none';
    }

    // Populate upcoming reservations
    const upcomingList = document.getElementById('upcoming-list');
    const now = new Date();
    const upcoming = reservations.filter(res => new Date(res.start) > now).sort((a, b) => new Date(a.start) - new Date(b.start));
    upcoming.forEach(res => {
        const li = document.createElement('li');
        li.textContent = `${res.service} - ${new Date(res.start).toLocaleDateString()} ${new Date(res.start).toLocaleTimeString()} - ${res.employee} (${res.status})`;
        li.className = res.status;
        upcomingList.appendChild(li);
    });

    // Notifications
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = tomorrow.toISOString().split('T')[0];
    const tomorrowReservations = reservations.filter(res => res.start.startsWith(tomorrowStr));
    if (tomorrowReservations.length > 0) {
        const message = `Tienes ${tomorrowReservations.length} reserva(s) mañana:\n` + tomorrowReservations.map(r => `${r.service} a las ${new Date(r.start).toLocaleTimeString()}`).join('\n');
        alert(message);
    }
});
