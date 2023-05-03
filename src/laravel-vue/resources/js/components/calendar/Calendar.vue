<template>
    <FullCalendar
        :options='calendarOptions'
    >
    </FullCalendar>
</template>

<script>
import { defineComponent } from 'vue'
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import rrulePlugin from '@fullcalendar/rrule'
import { INITIAL_EVENTS, createEventId } from './calendar-utils/event-utils'
import huLocale from "@fullcalendar/core/locales/hu";
import enLocale from "@fullcalendar/core/locales/en-gb"
import {useI18n} from "vue-i18n";

export default defineComponent({
    components: {
        FullCalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [
                    rrulePlugin,
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'en',
                locales: [ enLocale, huLocale ],
                initialView: 'dayGridMonth',
                initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents,
                /* you can update a remote database when these fire: */
                eventAdd: this.eventAdd,
                eventChange: this.eventChange,
                eventRemove: this.eventRemove,
                slotLabelFormat: { hour: 'numeric', minute: '2-digit', omitZeroMinute: false, hour12: false },
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: false },
            },
            currentEvents: [],
        }
    },
    methods: {
        handleDateSelect(info) {
            console.log("select");
        },
        handleEventClick(info) {
            console.log("click");
            info.event.remove();
        },
        handleEvents(info) {
            console.log("set");
        },
        eventAdd(info) {
            console.log("add");
        },
        eventChange(info) {
            console.log("change");
        },
        eventRemove(info) {
            console.log("remove");
        }
    },
    created() {
        const { locale } = useI18n({useScope: 'global'})
        this.calendarOptions.locale = locale.value;
        this.$watch(() =>locale.value,function () {
            this.calendarOptions.locale = locale.value;
        });
    },
})

</script>
