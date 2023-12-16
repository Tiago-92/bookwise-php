import { useEffect, useState } from 'react'
import { api } from './api'
import { useParams } from "react-router-dom";

interface BookData {
  name: string;
  author: string;
  category: string;
  summary: string;
  bookID: string;
  coverUrl: string
}

export function Book() {
  const [bookData, setBookData] = useState<BookData | null>(null)
  const params = useParams();

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await api.get<BookData>(`/book/${params.bookID}`)
        setBookData(response.data)
        console.log(response.data)
        
      } catch (error) {
        console.error('Erro ao buscar dados do livro:', error);
      }
    }

    fetchData()
  }, [])

  // const imageURL = bookData && `${api.defaults.baseURL}/book-covers/${bookData.coverUrl}`

  return (
    <div>
      {bookData ? (
        <div>
          <h2>{bookData.name}</h2>
          <p>Autor: {bookData.author}</p>
          <p>Categoria: {bookData.category}</p>
          <p>Resumo: {bookData.summary}</p>
        </div>
      ) : (
        <p>Carregando informações do livro...</p>
      )}
    </div>
  )
}
