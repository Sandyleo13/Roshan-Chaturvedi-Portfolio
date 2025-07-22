import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import { Helmet } from "react-helmet-async"; // <-- Add this import!
import { Calendar, Clock } from "lucide-react";
import { Badge } from "@/components/ui/badge";

interface Article {
  id: number;
  title: string;
  content: string;
  publishDate: string;
  tags: string[];
  readTime: string;
  difficulty: string;
  image: string | null;
  meta_title?: string | null;
  meta_description?: string | null;
  meta_keywords?: string | null;
  meta_image?: string | null;
  excerpt?: string | null;
}

const ArticleDetail = () => {
  const { slug } = useParams();
  const [article, setArticle] = useState<Article | null>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (!slug) return;

    fetch(`http://127.0.0.1:8000/api/articles/${slug}`)
      .then((res) => {
        if (!res.ok) {
          throw new Error("Article not found");
        }
        return res.json();
      })
      .then((data) => {
        setArticle({
          id: data.id,
          title: data.title,
          content: data.content,
          publishDate: new Date(data.created_at).toDateString(),
          tags: data.tags ? data.tags.split(",") : [],
          readTime: data.read_time || "5 min read",
          difficulty: data.difficulty || "Beginner",
          image: data.meta_image
            ? (data.meta_image.startsWith("http") ? data.meta_image : `http://127.0.0.1:8000/${data.meta_image}`)
            : (data.image
                ? (data.image.startsWith("http") ? data.image : `http://127.0.0.1:8000/${data.image}`)
                : null),
          meta_title: data.meta_title,
          meta_description: data.meta_description,
          meta_keywords: data.meta_keywords,
          meta_image: data.meta_image,
          excerpt: data.excerpt,
        });
        setLoading(false);
      })
      .catch((error) => {
        console.error(error);
        setLoading(false);
      });
  }, [slug]);

  if (loading) {
    return <div className="text-center py-10 text-muted-foreground">Loading article...</div>;
  }

  if (!article) {
    return <div className="text-center py-10 text-red-500">Article not found</div>;
  }

  // SEO meta logic
  const title = article.meta_title || article.title;
  const description = article.meta_description || article.excerpt || article.title;
  const image = article.meta_image || article.image;
  const keywords = article.meta_keywords || "";

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
          <meta property="og:image" content={image} />
        )}
        {/* Twitter */}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content={title} />
        <meta name="twitter:description" content={description} />
        {image && (
          <meta name="twitter:image" content={image} />
        )}
      </Helmet>

      <div className="min-h-screen pt-20 px-4 max-w-3xl mx-auto">
        {article.image && (
          <img
            src={article.image}
            alt={article.title}
            className="w-full h-72 object-cover rounded-2xl mb-6"
          />
        )}
        <h1 className="text-4xl font-bold mb-4">{article.title}</h1>
        <div className="flex items-center justify-between text-sm text-muted-foreground mb-4">
          <span className="flex items-center gap-1">
            <Calendar className="w-4 h-4" />
            {article.publishDate}
          </span>
          <span className="flex items-center gap-1">
            <Clock className="w-4 h-4" />
            {article.readTime}
          </span>
        </div>
        <div className="flex gap-2 flex-wrap mb-4">
          {article.tags.map((tag, i) => (
            <Badge key={i} variant="outline">
              {tag}
            </Badge>
          ))}
        </div>
        <div className="prose prose-lg max-w-none" dangerouslySetInnerHTML={{ __html: article.content }} />
      </div>
    </>
  );
};

export default ArticleDetail;
