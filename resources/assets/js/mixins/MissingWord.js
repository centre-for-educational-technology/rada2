import MissingWord from './../components/classes/MissingWord.js';
export default {
    methods: {
        missingWordsToArray(words) {
            let wordsArray = [];
            if (typeof words === 'undefined' || words.length <= 0) {
                return wordsArray;
            }
            let startParts = words.split('{');
            wordsArray.push(new MissingWord({
                type: 'text',
                text: startParts.shift(),
                answer: '',
                isCorrect: false
            }));
            let startPartsLength = startParts.length;
            for (let i=0; i<startPartsLength; i++) {
                let str = startParts[i];
                let endParts = str.split('}');
                if (endParts.length === 2) {
                    wordsArray.push(new MissingWord({
                        type: 'input',
                        text: endParts.shift(),
                        answer: '',
                        isCorrect: false
                    }));

                    wordsArray.push(new MissingWord({
                        type: 'text',
                        text: endParts.shift(),
                        answer: '',
                        isCorrect: false
                    }));
                }
            }
            return wordsArray;
        },
        missingWordsToString(wordsArray) {
            const length = wordsArray.length;
            let text = '';
            for (let i=0; i<length; i++) {
                let word = wordsArray[i];
                if (word.type === 'input') {
                    text += '{' + word.answer + '}';
                } else {
                    text += word.text;
                }
            }
            return text;
        }
    }
};