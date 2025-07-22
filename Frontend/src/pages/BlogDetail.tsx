import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { Helmet } from "react-helmet-async"; // << Add this line!

interface Blog {
  id: number;
  title: string;
  content: string;
  image?: string | null;
  created_at: string;
  excerpt?: string | null;
  meta_title?: string | null;
  meta_description?: string | null;
  meta_keywords?: string | null;
  meta_image?: string | null;
}

export default function BlogDetail() {
  const { slug } = useParams<{ slug: string }>();
  const [blog, setBlog] = useState<Blog | null>(null);

  useEffect(() => {
    fetch(`http://127.0.0.1:8000/api/blogs/${slug}`)
      .then((res) => {
        if (!res.ok) throw new Error("Blog not found");
        return res.json();
      })
      .then(setBlog)
      .catch(() => setBlog(null));
  }, [slug]);

  if (!blog) return <p className="text-center mt-10">Blog not found.</p>;

  // Format date
  const formattedDate = new Date(blog.created_at).toLocaleDateString(undefined, {
    year: 'numeric', month: 'long', day: 'numeric',
  });

  // SEO fallback logic
  const title = blog.meta_title || blog.title;
  const description = blog.meta_description || blog.excerpt || blog.title;
  const image = blog.meta_image || blog.image;
  const keywords = blog.meta_keywords || "";

  return (
    <>
      <Helmet>
        <title>{title}</title>
        <meta name="description" content={description} />
        <meta name="keywords" content={keywords} />
        {/* Open Graph / Facebook */}
        <meta property="og:type" content="article" />
        <meta property="og:title" content={title} />
        <meta property="og:description" content={description} />
        {image && (
          <meta property="og:image" content={`http://127.0.0.1:8000/storage/${image}`} />
        )}
        {/* Twitter */}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content={title} />
        <meta name="twitter:description" content={description} />
        {image && (
          <meta name="twitter:image" content={`http://127.0.0.1:8000/storage/${image}`} />
        )}
      </Helmet>
      <div className="max-w-3xl mx-auto mt-12 px-4 py-8 bg-white rounded-xl shadow-md">
        <h1 className="text-4xl font-extrabold mb-2 text-center">{blog.title}</h1>
        <div className="flex justify-center mb-2">
          <span className="text-sm text-gray-500">
            Published on {formattedDate}
          </span>
        </div>
        {blog.image && (
          <div className="w-full mb-6 flex justify-center">
            <img
              src={`http://127.0.0.1:8000/storage/${blog.image}`}
              alt={blog.title}
              className="rounded-lg max-h-96 object-contain shadow-xl bg-gray-100"
              style={{ maxWidth: '100%', maxHeight: '400px' }}
            />
          </div>
        )}
        <article
          className="prose prose-lg mx-auto text-gray-900"
          dangerouslySetInnerHTML={{ __html: blog.content }}
        />
      </div>
    </>
  );
}
