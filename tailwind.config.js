const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require("tailwindcss/plugin");

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary : {
                    100:"#FFC9B1",
                    300:"#FF8F5D",
                    500:"#FA6422",                    
                    700:"#E54600",
                    900:"#BC2900"
                },
                text : {
                    100:"#A0AEC0",
                    300:"#718096",
                    500:"#2D3748",                    
                    700:"#1A202C",
                    900:"#0C0F14"
                },
                textdark :  {
                    100:"#E4E8ED",
                    300:"#CFDAE8",
                    500:"#FFFFFF",                    
                    700:"#A0AEC0",
                    900:"#718096"
                },
                background : {
                    100:"#FFFFFF",
                    300:"#EAEFF5",
                    500:"#F1F5F8",                    
                    700:"#2D3748",
                    900:"#1A202C"
                },
                backgrounddark : {
                    100:"#CFD5DE",
                    300:"#43526A",
                    500:"#2D3748",                    
                    700:"#121821",
                    900:"#07090D"
                },
                general: {
                    100: "#8DC43B",
                    200: "#D32727",
                    300: "#3B8DC4",
                    400: "#723BC4",
                    500: "#C4B63B",
                    600: "#27D3D3",
                    700: "#D3277D",
                    800: "#D37D27",
                    900: "#2727D3"
                  },
                // Icons
                // Lines

                // theme: {
                //   1: "#1C3FAA",
                //   2: "#F1F5F8",
                //   3: "#2e51bb",
                //   4: "#3151BC",
                //   5: "#dee7ef",
                //   6: "#D32929",
                //   7: "#365A74",
                //   8: "#D2DFEA",
                //   9: "#91C714",
                //   10: "#3160D8",
                //   11: "#F78B00",
                //   12: "#FBC500",
                //   13: "#7F9EB9",
                //   14: "#E6F3FF",
                //   15: "#8DA9BE",
                //   16: "#607F96",
                //   17: "#FFEFD9",
                //   18: "#D8F8BC",
                //   19: "#E6F3FF",
                //   20: "#2449AF",
                //   21: "#284EB2",
                //   22: "#395EC1",
                //   23: "#D6E1FF",
                //   24: "#2e51bb",
                //   25: "#C6D4FD",
                //   26: "#E8EEFF",
                //   27: "#98AFF5",
                //   28: "#1A389F",
                //   29: "#142C91",
                //   30: "#8da3e6",
                //   31: "#ffd8d8",
                //   32: "#3b5998",
                //   33: "#4ab3f4",
                //   34: "#517fa4",
                //   35: "#0077b5",
                //   36: "#d18d96",
                //   37: "#c7d2ff",
                //   38: "#15329A",
                //   40: "#203FAD",
                //   41: "#BBC8FD"
                // },
                dark: {
                  100: "#5D777C",
                  200: "#4F646F",
                  300: "#435265",
                  400: "#313A55",
                  500: "#2A2C4B",
                  600: "#2A2C4B",
                  700: "#292441",
                  800: "#271D36",
                  900: "#24172C"
                }
              },
            //   fontFamily: {
            //     roboto: ["Roboto"]
            //   },
              container: {
                center: true
              },
              maxWidth: {
                "1/4": "25%",
                "1/2": "50%",
                "3/4": "75%"
              },
              screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                xxl: "1600px"
              },
              strokeWidth: {
                "0.5": 0.5,
                "1.5": 1.5,
                "2.5": 2.5
              }
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        tableLayout: ['responsive', 'hover', 'focus'],
        backgroundColor: [
            "last",
            "first",
            "odd",
            "responsive",
            "hover",
            "dark",
            "dark-hover"
          ],
          borderColor: [
            "last",
            "first",
            "odd",
            "responsive",
            "hover",
            "dark",
            "dark-hover"
          ],
          textColor: [
            "last",
            "first",
            "odd",
            "responsive",
            "hover",
            "dark",
            "dark-hover"
          ]
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('tailwindcss-rtl'),
        plugin(function({ addVariant, e }) {
            addVariant("dark", ({ modifySelectors, separator }) => {
            modifySelectors(({ className }) => {
                return `.dark .${e(`dark${separator}${className}`)}`;
            });
            });
            addVariant("dark-hover", ({ modifySelectors, separator }) => {
            modifySelectors(({ className }) => {
                return `.dark .${e(
                `dark${separator}hover${separator}${className}`
                )}:hover`;
            });
            });
        })
    ],
};

