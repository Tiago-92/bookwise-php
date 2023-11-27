import { useState } from 'react';
import { api } from './api';

export function App() {
  const [author, setAuthor] = useState("")
  const [coverUrl, setCoverUrl] = useState("")
  const [name, setName] = useState("")
  const [summary, setSummary] = useState("")
  const [totalPages, setTotalPages] = useState("")
  const [categoryId , setCategoryID] = useState(1)

  function handleCreateBook(event) {
    event.preventDefault();

    const bookData = {
      author: author,
      coverUrl: coverUrl,
      name: name,
      summary: summary,
      totalPages: parseInt(totalPages, 10),
      category_id: categoryId 
    }

    api.post("/books", bookData)
      .then(() => {
        alert("Livro cadastrado com sucesso!")

      }).catch((error) => {
        console.log("Erro ao cadastrar o livro", error)
      })
    }

  return (
    <div>
      <form onSubmit={handleCreateBook}>
        <input 
          placeholder='Autor do Livro'
          value={author}
          onChange={e => setAuthor(e.target.value)}
        />
        <input 
          placeholder='Imagem do Livro'
          value={coverUrl}
          onChange={e => setCoverUrl(e.target.value)}
        />
        <input 
          placeholder='Descrição do Livro'
          value={summary}
          onChange={e => setSummary(e.target.value)}
        />
        <input 
          placeholder='Nome do Livro'
          value={name}
          onChange={e => setName(e.target.value)}
        />
        <input 
          placeholder='Total de Páginas'
          value={totalPages}
          onChange={e => setTotalPages(e.target.value)}
        />

        <button type="submit">
          Salvar Livro
        </button>
      </form>
    </div>
  );
}
