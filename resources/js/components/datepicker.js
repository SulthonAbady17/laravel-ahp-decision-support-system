// resources/js/components/datepicker.js

export default (config = { initialValue: null }) => ({
    datePickerOpen: false,
    datePickerValue: "",
    datePickerFormat: "YYYY-MM-DD", // Format standar untuk backend
    datePickerDisplayFormat: "M d, Y", // Format yang dilihat pengguna
    datePickerMonth: "",
    datePickerYear: "",
    datePickerDaysInMonth: [],
    datePickerBlankDaysInMonth: [],
    datePickerMonthNames: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ],
    datePickerDays: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],

    init() {
        let today;
        if (config.initialValue) {
            today = new Date(Date.parse(config.initialValue));
        } else {
            today = new Date();
        }
        this.datePickerMonth = today.getMonth();
        this.datePickerYear = today.getFullYear();
        this.datePickerValue = this.formatDateForBackend(today);
        this.datePickerCalculateDays();
    },

    formatDateForBackend(date) {
        let formattedMonth = ("0" + (date.getMonth() + 1)).slice(-2);
        let formattedDay = ("0" + date.getDate()).slice(-2);
        return `${date.getFullYear()}-${formattedMonth}-${formattedDay}`;
    },

    formatDateForDisplay(date) {
        let formattedMonthShort = this.datePickerMonthNames[
            date.getMonth()
        ].substring(0, 3);
        let formattedDay = ("0" + date.getDate()).slice(-2);
        return `${formattedMonthShort} ${formattedDay}, ${date.getFullYear()}`;
    },

    datePickerDayClicked(day) {
        let selectedDate = new Date(
            this.datePickerYear,
            this.datePickerMonth,
            day
        );
        this.datePickerValue = this.formatDateForBackend(selectedDate);
        this.datePickerOpen = false;
    },

    datePickerPreviousMonth() {
        if (this.datePickerMonth == 0) {
            this.datePickerYear--;
            this.datePickerMonth = 11;
        } else {
            this.datePickerMonth--;
        }
        this.datePickerCalculateDays();
    },

    datePickerNextMonth() {
        if (this.datePickerMonth == 11) {
            this.datePickerMonth = 0;
            this.datePickerYear++;
        } else {
            this.datePickerMonth++;
        }
        this.datePickerCalculateDays();
    },

    datePickerIsSelectedDate(day) {
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return this.datePickerValue === this.formatDateForBackend(d);
    },

    datePickerIsToday(day) {
        const today = new Date();
        const d = new Date(this.datePickerYear, this.datePickerMonth, day);
        return today.toDateString() === d.toDateString();
    },

    datePickerCalculateDays() {
        let daysInMonth = new Date(
            this.datePickerYear,
            this.datePickerMonth + 1,
            0
        ).getDate();
        let dayOfWeek = new Date(
            this.datePickerYear,
            this.datePickerMonth
        ).getDay();
        this.datePickerBlankDaysInMonth = Array.from(
            { length: dayOfWeek },
            (_, i) => i + 1
        );
        this.datePickerDaysInMonth = Array.from(
            { length: daysInMonth },
            (_, i) => i + 1
        );
    },
});
