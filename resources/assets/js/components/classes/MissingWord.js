module.exports = class MissingWord {
    constructor(data) {
        this.type = data.type;
        this.text = data.text;
        this.answer = data.answer;
        this.isCorrect = data.isCorrect;
    }
}