import { createRoot } from 'react-dom/client'
import App from './App.tsx'
import './index.css'
import "@fontsource/sora/400.css"
import "@fontsource/sora/700.css"
import { HelmetProvider } from 'react-helmet-async';

createRoot(document.getElementById("root")!).render(<App />);
document.body.style.fontFamily = "'Sora', sans-serif";
<HelmetProvider>
  <App />
</HelmetProvider>