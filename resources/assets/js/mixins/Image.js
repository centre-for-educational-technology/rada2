export default {
    methods: {
        isValidImageFormat(file) {
            return file.type === 'image/jpg' || file.type === 'image/jpeg' || file.type == 'image/png';
        }
    }
};
