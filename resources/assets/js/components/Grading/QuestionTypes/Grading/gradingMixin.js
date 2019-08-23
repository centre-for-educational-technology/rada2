export default {
    methods: {
        getMaxGrade() {
            return this.maxGrade;
        },
        getFinalGrade() {
            return this.grade;
        },
        canSubmit() {
            const finalGrade = this.getFinalGrade();
            const maxGrade = this.getMaxGrade();
            return finalGrade >= 0 && finalGrade <= maxGrade;
        },
        onButtonSubmit(e) {
            e.preventDefault();
            if (this.canSubmit()) {
                this.onSubmit(this.getFinalGrade())
            }
            return false;
        }
    }
}