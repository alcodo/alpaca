export default {
    props: [
        'html',
    ],
    components: {},
    data() {
        return {
            content: null,
        };
    },
    created() {
        this.content = this.html;
    },
    methods: {},
    computed: {},
};