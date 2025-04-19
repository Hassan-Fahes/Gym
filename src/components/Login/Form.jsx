import React from 'react'

function Form() {
  return (
    <div className='flex w-[50%] flex-col justify-center items-center'>
        <h1>Welome to <span>Gym</span></h1>
        <h2>Sign In</h2>
        <form className='flex mt-5 flex-col gap-5'>
            <input type="text" placeholder='Username' className='border border-gray-400 rounded-md px focus:outline-none focus:border' />
            <input type="text" placeholder='Password' className='border border-black focus:outline-none focus:border' />
        </form>
    </div>
  )
}

export default Form
