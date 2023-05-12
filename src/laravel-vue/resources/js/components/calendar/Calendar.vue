<template>
    <div>
        <FullCalendar
            :options='calendarOptions'
        >
        </FullCalendar>
        <CalendarModalAdd ref="modalAdd" :start="modalAddStartStr" :end="modalAddEndStr" :all-day="modalAddAllDay" :api="modalApi"/>
    </div>
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
import CalendarModalAdd from "./CalendarModalAdd.vue";
import {api} from "../../utils/api";
import {star} from "ionicons/icons";

export default defineComponent({
    components: {
        CalendarModalAdd,
        FullCalendar,
    },
    data() {
        return {
            ////// modal add prop
            modalAddStartStr: "",
            modalAddEndStr: "",
            modalAddAllDay: true,
            modalApi: {},
            //////
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
                select: this.dateSelect,
                eventClick: this.eventClick,
                eventsSet: this.eventSet,
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
        dateSelect(info) {
            console.log("select");
            this.modalAddStartStr = info.startStr;
            this.modalAddEndStr = info.endStr;
            this.modalAddAllDay = info.allDay;
            let calendarApi = info.view.calendar;
            this.modalApi = calendarApi;
            calendarApi.unselect();
            this.$refs.modalAdd.show();
        },
        eventClick(info) {
            console.log("click");
        },
        eventSet(info) {
            console.log("set");
        },
        eventAdd(info) {
            console.log("add");
        },
        async eventChange(info) {
            console.log("change");
            switch (info.event.extendedProps.date_type) {
                case "date":
                    let start = new Date(info.event.start);
                    let end = new Date(info.event.end);
                    start.setHours(start.getHours()+2);
                    end.setHours(end.getHours()+2);
                    if (info.event.allDay) {
                        end.setDate(end.getDate()-1);
                    }
                    if (info.event.end === null) {
                        if (info.event.allDay) {
                            end = start;
                        }
                        else {
                            let start_copy = new Date(start);
                            start_copy.setHours(start.getHours()+1);
                            end = new Date(start_copy);
                        }
                    }
                    const data = {
                        start: start.toISOString().split('.')[0],
                        end: end.toISOString().split('.')[0],
                        allDay: info.event.allDay
                    };
                    await api.post("/user/date/"+info.event.id,data);
                    break;

                case "routine":
                    break;
            }
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
    }
})

</script>
