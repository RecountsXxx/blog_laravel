// EditorComponent.js
import React, { useEffect, useRef, useState } from 'react';
import './style.css';
import axios from "axios";
import { Editor } from "@tinymce/tinymce-react";
import { ToastContainer, toast } from 'react-toastify';
import { addPost, fetchCategories } from '../../services/editor/EditorService';
import { Redirect } from 'react-router-dom';
export default function EditorComponent() {
    const [selectedCategory, setSelectedCategory] = useState('');
    const editorRef = useRef(null);
    const [categories, setCategories] = useState([]);
    const [title, setTitle] = useState('');
    const [loading, setLoading] = useState(false);
    const [user,setUser] = useState(JSON.parse(localStorage.getItem('user')));

    if(!user){
        return 'Please login';
    }

    useEffect(() => {
        const fetchData = async () => {
            const categoriesData = await fetchCategories();
            setCategories(categoriesData);
        };
        fetchData();
    }, []);

    const handleSelectCategory = (event) => {
        setSelectedCategory(event.target.value);
    };

    const handleButtonClick = async () => {
        setLoading(true);
        const editorContent = editorRef.current.getContent();

        if (title.length < 6) {
            toast.error('Enter the title or title length < 6 symbols');
            setLoading(false);
            return;
        }
        if (editorContent.length < 50) {
            toast.error('Enter the content or content length < 50 symbols');
            setLoading(false);
            return;
        }
        if (!selectedCategory) {
            toast.error('Select a category');
            setLoading(false);
            return;
        }

        const author = JSON.parse(localStorage.getItem('user'))[0];
        console.log(author);
        if(author.is_banned_posts == true){
            toast.error('You already banned');
            return;
        }
        const result = await addPost(title, editorContent, author.id, selectedCategory);

        if (result.success) {
            toast.success('Post adding is successful');
        } else {
            toast.error(result.error || 'Failed to add post');
        }

        setLoading(false);
    };

    return (
        <div className="col-md-10 container-fluid ">
            <ToastContainer></ToastContainer>
            <div className="d-flex flex-row">
                <div className="container-fluid mt-4 col-md-8">
                    <Editor
                        onInit={(evt, editor) => editorRef.current = editor}
                        apiKey='r2ocyfbgbjzp492pzua9p6kqum9ru80ae589dramspkbnbnf'
                        init={{
                            height: 900,
                            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                        }}
                    />
                </div>
                <div className="container-fluid mt-4 col-md-4">
                    <div className="row">
                        <div className="col-md-12">
                            <label htmlFor="category">Category</label>
                            <select value={selectedCategory} id="category" className="w-100 form-select mt-3"
                                    aria-label="Default select example" onChange={handleSelectCategory}>
                                <option value="">Select a category</option>
                                {categories.map(item => (
                                    <option key={item.id} value={item.id}>{item.name}</option>
                                ))}
                            </select>
                            <label htmlFor="title" className="mt-2">Title</label>
                            <input required type="text" id="title" value={title} className="form-control"
                                   placeholder="Enter the title" onChange={(event) => setTitle(event.target.value)}/>
                            <button onClick={handleButtonClick} className="mt-3 btn btn-primary form-control"
                                    disabled={loading}>{loading ? 'Processing...' : 'Add post'}</button>
                            <div className="post-description mt-5">
                                <h3>What can you add to your posts?</h3>
                                <ul>
                                    <li><strong>Text:</strong> Describe your thoughts, ideas, stories, or research.</li>
                                    <li><strong>Images:</strong> Add colorful images to illustrate your post.</li>
                                    <li><strong>Video:</strong> Embed videos to better convey your message.</li>
                                    <li><strong>Links:</strong> Share useful links to articles, resources, or other
                                        sources.
                                    </li>
                                    <li><strong>Tags:</strong> Use tags to help other users easily find your content.
                                    </li>
                                </ul>
                                <h3>What should not be included in posts?</h3>
                                <p>Please remember that it is important to maintain a respectful and friendly atmosphere
                                    in our community. Do not include the following in your posts:</p>
                                <ul>
                                    <li><strong>Profanity:</strong> Please avoid using profanity or offensive language.
                                    </li>
                                    <li><strong>Inappropriate content:</strong> Do not publish content that violates
                                        copyright, contains inappropriate material, is offensive, or is otherwise
                                        unsuitable.
                                    </li>
                                    <li><strong>Spam:</strong> Do not post mass or unwanted messages.</li>
                                </ul>
                                <p>Thank you for your contribution to our community! We are delighted to see your
                                    creativity and ideas.</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>
)
    ;
}
