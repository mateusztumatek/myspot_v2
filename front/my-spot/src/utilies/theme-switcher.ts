import {useStorage} from "@vueuse/core";

const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

let theme = useStorage('theme', prefersDark.matches ? 'dark' : 'light');

const setTheme = () => {
    if (theme.value === 'dark') {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
}

setTheme();
const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    setTheme();
}
export {
    theme,
    toggleTheme,
    setTheme
}