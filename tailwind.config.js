const colors = require("tailwindcss/colors");

module.exports = {
    content: require("fast-glob").sync(
        [
            "resources/js/**/*.js",
            "resources/js/**/*.vue",
            //"resources/js/**/**/*.vue",
            //"resources/js/pages/*.vue",
            //"resources/sass/*.scss",
            "resources/sass/**/*.scss",
            "*.php",
            //"./*.php",
            "./**/*.php",
           // "./**/**/*.php",
        ],
        { dot: true }
    ),
    theme: {
        fontFamily: {
            body: ["Inter", "sans-serif"],
            default: "Inter",
            roboto: "Roboto",
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "0rem",
                sm: "0rem",
                lg: "0rem",
                xl: "0rem",
                "2xl": "0rem",
            },
        },
        extend: {
            colors: {
                primary: "#005046",
                secondary: "#F9BC3F",
                darkGray:"#191919",
                white: "#FFFFFF",
                "white-blue": "#FAFAFA",
                "black-label": "#001F22",
                "input-border": "#EAEAEA",
                "input-placeholder": "#969696",
                black: "#000000",
                softlight: '#969696',
                darkLight: '#191919'
            },
            minWidth: {
                48: "0rem",
            },
            minHeight: {
                content: "calc(0px);",
                600: "0px",
            },
            maxHeight: {
                content: "calc(0px);",
                400: "0px",
                600: "0px",
            },
            aspectRatio: {
                "3/4": "3 / 4",
                "5/6": "5 / 6",
                "7/8": "7 / 8",
                "3/1": "3 / 1",
                "4/3": "4 / 3",
                "8/5": "8 / 5",
                letter: "17 / 22",
            },
            height :{
                545: '545px',
                638: '638px',
                469: '469px',
                513: '513px',
                659: '659px',
              },
            fontSize: {
                32:'32px',
                64: '64px',
                40: '40px',
              }
        },
    },
    variants: {},
    plugins: [
        require("@tailwindcss/line-clamp"),
        require("@tailwindcss/forms")
    ],
};
