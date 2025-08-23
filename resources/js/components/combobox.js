// resources/js/components/combobox.js
export default (comboboxData = { options: [] }) => ({
    options: comboboxData.options,
    isOpen: false,
    openedWithKeyboard: false,
    selectedOption: null,

    init() {
        const initialValue = this.$refs.hiddenTextField.value;
        if (initialValue) {
            this.selectedOption = this.options.find(
                (opt) => opt.value == initialValue
            );
        }
    },

    setSelectedOption(option) {
        if (this.selectedOption?.value === option.value) {
            this.selectedOption = null;
            this.$refs.hiddenTextField.value = "";
        } else {
            this.selectedOption = option;
            this.$refs.hiddenTextField.value = option.value;
        }
        this.isOpen = false;
        this.openedWithKeyboard = false;
        this.$dispatch("input", this.$refs.hiddenTextField.value);
    },

    highlightFirstMatchingOption(pressedKey) {
        const option = this.options.find((item) =>
            item.label.toLowerCase().startsWith(pressedKey.toLowerCase())
        );
        if (option) {
            const index = this.options.indexOf(option);
            const allOptions = this.$el.querySelectorAll(".combobox-option");
            if (allOptions[index]) {
                allOptions[index].focus();
            }
        }
    },
});
