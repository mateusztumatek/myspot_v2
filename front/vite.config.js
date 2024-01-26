import vue from '@vitejs/plugin-vue'
import vuetify, {transformAssetUrls} from 'vite-plugin-vuetify'


export default {
    plugins: [
        vue(
            {
                template: { transformAssetUrls }
            }
        ),
        vuetify(),
    ],
}