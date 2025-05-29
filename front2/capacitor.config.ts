import { CapacitorConfig } from '@capacitor/cli';

const config: CapacitorConfig = {
  appId: 'io.ionic.myspot',
  appName: 'MySpot',
  webDir: 'dist',
  server: {
    androidScheme: 'https'
  }
};

export default config;
