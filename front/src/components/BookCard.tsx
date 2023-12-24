import { Star } from 'phosphor-react'

interface BookCardProps {
  width?: string
  height?: string
}

export default function BookCard({ width }: BookCardProps) {
  return (
    <div
      className={`md:flex md:flex-row md:gap-[1.25rem] w-${width} md:w-[${width}] bg-gray-7# rounded-md py-[1.25rem] px-[1.25rem]`}
    >
      <div className="float-left md:float-none">
        {/* <Image src={theHobbit} alt="" width={64} height={94} /> */}
      </div>

      <div className="flex flex-col ml-[90px] md:ml-0">
        <span className="text-base text-gray-1#">A Revolução dos Bichos</span>
        <span className="text-sm text-gray-4#">George Orwell</span>

        <div className="flex gap-1 mt-[0.5rem] md:mt-[1rem]">
          <Star className="text-purple-1#" />
          <Star className="text-purple-1#" />
          <Star className="text-purple-1#" />
          <Star className="text-purple-1#" />
          <Star className="text-purple-1#" />
        </div>
      </div>
    </div>
  )
}