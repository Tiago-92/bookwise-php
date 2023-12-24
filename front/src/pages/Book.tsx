import { useEffect, useState } from 'react'
import { api } from '../api'
/* import { Link } from 'react-router-dom'; */
import CommentCard from '../components/CommentCard';
import BookCard from '../components/BookCard';

export function Book() {
  const [bookData, setBookData] = useState([])

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await api.get("/books")
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
    <main className="flex flex-col md:flex-row md:ml-24 ml-[1.5rem] relative">
      <section>
       {/*  <img
          src={logoTitle}
          alt="image of"
          className="flex md:hidden text-2xl text-gray-1# mt-[2rem]"
        /> */}
        <h1 className="hidden md:flex gap-[0.75rem] mt-[2rem] md:mt-[4.5rem] text-[1.5rem] font-bold text-gray-1#">
         {/*  <ChartLineUp className="text-green-1# w-8 h-8" /> */}
          Início
        </h1>

        {/* <div onClick={handleOpenMenu} className="mt-[1.5rem] md:hidden">
          {openSideBar ? (
            <>
              <X width={40} height={40} color="#FFF" />
              <div className="absolute">
                <SideBarMobile />
              </div>
            </>
          ) : (
            <List width={40} height={40} color="#FFF" />
          )}
        </div> */}

        <div className="mt-[2.5rem] mb-[1rem] w-[380px] md:w-full">
          <h2 className="text-sm mb-[0.75rem] text-gray-1#">
            Avaliações mais recentes
          </h2>
          <div className="w-[320px] flex gap-[0.75rem] overflow-x-auto md:flex-col md:w-full">
            {bookData.map(book => (
              <CommentCard key={book} data={book} />
            ))}
          </div>
        </div>
      </section>

      <section className="flex flex-col gap-[0.75rem] mt-[1rem] md:mt-[9.38rem] ml-[0.5rem] md:ml-[4rem] ">
        <div className="flex flex-col md:flex md:flex-row md:justify-between">
          <span className="text-sm text-gray-1#">Livros populares</span>
          {/* <Link
            className="flex items-center gap-[0.5rem] text-sm text-purple-1#"
            href="/"
          >
            Ver todos
            <CaretRight />
          </Link> */}
        </div>
        <div className="w-[320px] md:w-full flex overflow-x-auto md:flex-col gap-[1rem]">
          <BookCard width="24rem" />
          <BookCard width="30" />
          <BookCard width="20" />
        </div>
        {/* <DetailsProfile /> */}
      </section>
    </main>
  )
}

