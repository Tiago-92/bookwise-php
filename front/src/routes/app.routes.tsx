import { Routes, Route } from 'react-router-dom'
import { Book } from '../Book'


export function AppRoutes() {
   return (
      <Routes>
         <Route path="/book/:bookID" element={<Book />} />
      </Routes>
   )
}