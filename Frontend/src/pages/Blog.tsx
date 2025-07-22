import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { Badge } from "@/components/ui/badge";

type Blog = {
  id: number;
  title: string;
  slug: string;
  content: string;
  image?: string;
  published_at?: string;
  readTime?: string;
  category?: string;
  excerpt?: string;
  featured?: boolean;
};

const Blog = () => {
  const [posts, setPosts] = useState<Blog[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch("http://127.0.0.1:8000/api/blogs")
      .then((res) => res.json())
      .then((data) => {
        setPosts(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Blog fetch error:", err);
        setLoading(false);
      });
  }, []);

  return (
    <div className="container mx-auto px-4 py-16">
      <h1 className="text-4xl font-bold mb-10">Latest Blogs</h1>

      <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
        {loading
          ? Array.from({ length: 6 }).map((_, idx) => (
              <div
                key={idx}
                className="bg-white shadow-md rounded-lg overflow-hidden animate-pulse"
              >
                <div className="h-48 bg-gray-200 w-full" />
                <div className="p-4 space-y-3">
                  <div className="h-4 bg-gray-300 rounded w-3/4"></div>
                  <div className="h-3 bg-gray-200 rounded w-1/2"></div>
                  <div className="h-3 bg-gray-200 rounded w-full"></div>
                  <div className="h-3 bg-gray-200 rounded w-5/6"></div>
                </div>
              </div>
            ))
          : posts.map((post) => (
              <Link
                to={`/blog/${post.slug}`}
                key={post.id}
                className="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition duration-300"
              >
                {post.image ? (
                  <img
                    src={`http://127.0.0.1:8000/storage/${post.image}`}
                    alt={post.title}
                    className="w-full h-48 object-cover"
                  />
                ) : (
                  <div className="h-48 bg-gray-200" />
                )}
                <div className="p-4">
                  <h2 className="text-xl font-semibold mb-2">{post.title}</h2>
                  {post.category && (
                    <Badge variant="outline" className="mb-2">
                      {post.category}
                    </Badge>
                  )}
                  <p className="text-sm text-muted-foreground line-clamp-3">
                    {post.excerpt ??
                      post.content.substring(0, 100).trim() + "..."}
                  </p>
                </div>
              </Link>
            ))}
      </div>
    </div>
  );
};

export default Blog;
