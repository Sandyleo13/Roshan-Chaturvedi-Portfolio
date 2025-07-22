import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import { Calendar, Clock } from 'lucide-react';
import { Skeleton } from '@/components/ui/skeleton';

interface Article {
  id: number;
  title: string;
  excerpt: string;
  publishDate: string;
  slug: string;
  readTime: string;
  difficulty: string;
  tags: string[];
  image: string | null;
}

const Articles = () => {
  const [articles, setArticles] = useState<Article[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/articles')
      .then((res) => res.json())
      .then((data) => {
        const formatted = data.map((article: any) => ({
          id: article.id,
          slug: article.slug,
          title: article.title,
          excerpt: article.excerpt ?? article.content?.slice(0, 150) ?? '',
          publishDate: new Date(article.created_at).toDateString(),
          readTime: '5 min read',
          difficulty: article.difficulty || 'Beginner',
          tags: article.tags ? article.tags.split(',') : [],
          image: article.image
            ? article.image.startsWith('http')
              ? article.image
              : `http://127.0.0.1:8000/${article.image}`
            : null,
        }));
        setArticles(formatted);
        setLoading(false);
      })
      .catch((error) => {
        console.error(error);
        setLoading(false);
      });
  }, []);

  const SkeletonCard = () => (
    <div className="rounded-2xl border shadow-sm overflow-hidden bg-white animate-pulse">
      <Skeleton className="w-full h-48" />
      <div className="p-6 space-y-4">
        <Skeleton className="h-4 w-2/3" />
        <Skeleton className="h-4 w-1/3" />
        <Skeleton className="h-4 w-full" />
        <Skeleton className="h-4 w-5/6" />
        <div className="flex gap-2">
          <Skeleton className="h-6 w-16 rounded-full" />
          <Skeleton className="h-6 w-12 rounded-full" />
        </div>
        <Skeleton className="h-8 w-24 rounded-md" />
      </div>
    </div>
  );

  return (
    <div className="min-h-screen pt-16">
      <section className="py-12 bg-gradient-subtle">
        <div className="container mx-auto px-4">
          <div className="text-center max-w-2xl mx-auto">
            <h2 className="text-4xl font-bold mb-4">Articles</h2>
            <p className="text-muted-foreground text-lg">
              Explore insights, guides, and tutorials crafted with care.
            </p>
          </div>
        </div>
      </section>

      <section className="container mx-auto px-4 py-16">
        {loading ? (
          <div className="grid md:grid-cols-2 gap-8">
            {[...Array(4)].map((_, index) => (
              <SkeletonCard key={index} />
            ))}
          </div>
        ) : articles.length === 0 ? (
          <div className="text-center text-muted-foreground">No articles found.</div>
        ) : (
          <div className="grid md:grid-cols-2 gap-8">
            {articles.map((article) => (
              <div
                key={article.id}
                className="rounded-2xl border shadow-sm hover:shadow-lg transition-shadow overflow-hidden bg-white"
              >
                {article.image && (
                  <img
                    src={article.image}
                    alt={article.title}
                    className="w-full h-48 object-cover"
                  />
                )}
                <div className="p-6">
                  <div className="flex items-center justify-between text-sm text-muted-foreground mb-2">
                    <span className="flex items-center gap-1">
                      <Calendar className="w-4 h-4" />
                      {article.publishDate}
                    </span>
                    <span className="flex items-center gap-1">
                      <Clock className="w-4 h-4" />
                      {article.readTime}
                    </span>
                  </div>
                  <h3 className="text-xl font-semibold mb-2">{article.title}</h3>
                  <p className="text-muted-foreground mb-4">{article.excerpt}...</p>
                  <div className="flex flex-wrap gap-2 mb-4">
                    {article.tags.map((tag, i) => (
                      <Badge key={i} variant="outline">
                        {tag}
                      </Badge>
                    ))}
                  </div>
                  <Link to={`/articles/${article.slug}`}>
                    <Button variant="outline">Read More</Button>
                  </Link>
                </div>
              </div>
            ))}
          </div>
        )}
      </section>
    </div>
  );
};

export default Articles;
