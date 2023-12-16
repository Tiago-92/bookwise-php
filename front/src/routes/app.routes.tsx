import { Routes, Route } from 'react-router-dom'
import { Book } from '../pages/Book'
import { App } from '../pages/App'


export function AppRoutes() {
   return (
      <Routes>
         <Route path="/" element={<Book />} />
         <Route path="/register" element={<App />} />
      </Routes>
   )
}